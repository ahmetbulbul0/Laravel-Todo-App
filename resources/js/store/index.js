import { createStore } from "vuex";
import router from "../router";
import { getRequest } from "../api";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

export default createStore({
    state: {
        token: "",
        username: "",
        fullName: "",
        userType: "",
        loginError: "",
        fullNameError: "",
        usernameError: "",
        passwordError: "",
        emailError: "",
        myTodosSorting: "",
        myTodosFilter: "",
        myTodosPage: ""
    },
    getters: {},
    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        setUser(state, user) {
            state.username = user.username;
            state.fullName = user.full_name;
            state.userType = user.type;
        },
        logOutData(state) {
            state.token = "";
            state.username = "";
            state.fullName = "";
            state.userType = "";
            state.myTodosSorting = "";
            state.myTodosFilter = "";
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
        setMyTodosSorting(state, sorting) {
            state.myTodosSorting = sorting
        },
        setMyTodosFilter(state, filter) {
            state.myTodosFilter = filter
        },
        setPage(state, page) {
            state.myTodosPage = page
        }
    },
    actions: {
        async login(state, data) {
            await axios.post("http://localhost:8000/api/login", data)
                .then(function (response) {
                    if (response.data.user && response.data.token && response.data.status == "ok") {
                        var user = response.data.user;
                        var token = response.data.token;
                        state.commit("setToken", token);
                        state.commit("setUser", user);
                    } else {
                        state.commit("loginError");
                    }
                });
        },
        async register(state, data) {
            state.commit("resetRegisterErrors");
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
        },
    },
    modules: {},
    plugins: [createPersistedState()],
});
