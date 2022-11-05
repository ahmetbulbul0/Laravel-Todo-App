import { createStore } from "vuex";
import router from "../router";
import { getRequest } from "../api";

export default createStore({
    state: {
        basicToken: localStorage.basicToken,
        adminToken: localStorage.adminToken,
        userToken: localStorage.userToken,
        username: localStorage.username,
        fullName: localStorage.fullName,
        loginError: "",
        fullNameError: "",
        usernameError: "",
        passwordError: "",
        emailError: ""
    },
    getters: {
    },
    mutations: {
        setTokens(state, tokens) {
            state.basicToken = tokens.basic;
            state.adminToken = tokens.admin;
            state.userToken = tokens.user;
            localStorage.setItem('basicToken', tokens.basic);
            localStorage.setItem('adminToken', tokens.admin);
            localStorage.setItem('userToken', tokens.user);
        },
        setUser(state, user) {
            state.username = user.username;
            state.fullName = user.full_name;
            localStorage.setItem('username', user.username);
            localStorage.setItem('fullName', user.full_name);
        },
        logOut(state) {
            localStorage.removeItem('basicToken');
            localStorage.removeItem('adminToken');
            localStorage.removeItem('userToken');
            localStorage.removeItem('username');
            localStorage.removeItem('fullName');
            router.push({ name: "Login" });
        },
        loginError(state) {
            state.loginError = "Login Failed";
        },
        registerErrors(state, errors) {
            if (errors.fullName) {
                state.fullNameError = errors.fullName[0];
            }
            if (errors.username) {
                state.usernameError = errors.username[0];
            }
            if (errors.password) {
                state.passwordError = errors.password[0];
            }
            if (errors.email) {
                state.emailError = errors.email[0];
            }
            router.push({ name: "Register" });
        }
    },
    actions: {
        async login(state, fData) {
            const data = {
                email: fData.email,
                password: fData.password,
            };
            await axios.post("http://localhost:8000/api/login", { email: data.email, password: data.password }).then(function (res) {
                if (res.data.user && res.data.tokens) {
                    var user = res.data.user;
                    var tokens = res.data.tokens;
                    console.log("user", user, "tokens", tokens);
                    state.commit("setTokens", tokens);
                    state.commit("setUser", user);
                    router.push({ name: 'MyTodos' })
                } else {
                    state.commit("loginError")
                }
            });
        },
        async register(state, fData) {
            state.fullNameError = '';
            state.usernameError = '';
            state.passwordError = '';
            state.emailError = '';

            const data = {
                fullName: fData.fullName,
                username: fData.username,
                password: fData.password,
                email: fData.email,
                type: "user"
            };

            await axios.post("http://localhost:8000/api/users", data).catch(function (error) {
                if (error.response) {
                    state.commit("registerErrors", error.response.data.errors)
                }
            });
            if (!state.registerErrors) {
                state.dispatch("login", { email: data.email, password: data.password });
            }
        },
        async getTodos(state) {
            const todos = await getRequest("todos");
            console.log(todos);
        }
    },
    modules: {
    }
})
