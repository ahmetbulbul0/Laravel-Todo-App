import { createStore } from "vuex";
import router from "../router";
import { getRequest } from "../api";
import axios from "axios";

export default createStore({
    state: {
        token: localStorage.token,
        username: localStorage.username,
        fullName: localStorage.fullName,

        loginError: "",

        fullNameError: "",
        usernameError: "",
        passwordError: "",
        emailError: "",
    },
    getters: {},
    mutations: {
        setToken(state, token) {
            localStorage.setItem("token", token);
        },
        setUser(state, user) {
            localStorage.setItem("username", user.username);
            localStorage.setItem("fullName", user.full_name);
        },
        logOutData(state) {
            localStorage.removeItem("token");
            localStorage.removeItem("username");
            localStorage.removeItem("fullName");
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
        },
        resetRegisterErrors(state) {
            state.fullNameError = null;
            state.usernameError = null;
            state.passwordError = null;
            state.emailError = null;
        },
    },
    actions: {
        async login(state, fData) {
            const data = {
                email: fData.email,
                password: fData.password,
            };
            await axios
                .post("http://localhost:8000/api/login", {
                    email: data.email,
                    password: data.password,
                })
                .then(function (res) {
                    if (
                        res.data.user &&
                        res.data.token &&
                        res.data.status == "ok"
                    ) {
                        var user = res.data.user;
                        var token = res.data.token;
                        state.commit("setToken", token);
                        state.commit("setUser", user);
                        router.push({ name: "MyTodos" });
                    } else {
                        state.commit("loginError");
                    }
                });
        },
        async register(state, fData) {
            state.commit("resetRegisterErrors");

            const data = {
                fullName: fData.fullName,
                username: fData.username,
                password: fData.password,
                email: fData.email,
                type: "user",
            };

            await axios
                .post("http://localhost:8000/api/register", data)
                .catch(function (error) {
                    state.commit("registerErrors", error.response.data.errors);
                })
                .then(function (res) {
                    if (res) {
                        state.dispatch("login", {
                            email: data.email,
                            password: data.password,
                        });
                    }
                });
        },
        async getTodos(state) {
            const todos = await getRequest("todos");
        },
        logOut(state) {
            state.commit("logOutData");
            router.push({ name: "Login" });
        },
    },
    modules: {},
});
