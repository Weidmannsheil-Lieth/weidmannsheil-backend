import axios from "../../axios";
import router from "../../router";

const state = {
    isAuth: !!localStorage.getItem('isAuth'),
    user: null,
    accessToken: localStorage.getItem('apiToken')
};

const getters = {
    isAuth: (state) => state.isAuth,
    user: (state) => state.user,
    apiToken: (state) => state.accessToken,
};

const mutations = {
    SET_USER(state, userData) {
        state.user = userData
    },
    SET_IS_AUTH(state, isAuth) {
        state.isAuth = isAuth;
        localStorage.setItem('isAuth', isAuth);
    },
    UNSET_AUTH(state) {
        state.isAuth = false;
        state.user = null;
        localStorage.removeItem('apiToken');
        localStorage.removeItem('isAuth');
    },
    SET_API_TOKEN(state, apiToken) {
        state.accessToken = apiToken;
        localStorage.setItem('apiToken', apiToken);
    }
};

const actions = {
    login({commit}, loginForm) {
        return new Promise((resolve, reject) => {
            axios.post('auth/login', loginForm)
                .then((response) => {
                    commit('SET_API_TOKEN', response.data.user.apiToken);
                    commit('SET_USER', response.data.user);
                    commit('SET_IS_AUTH', true);
                    resolve(response)
                })
                .catch(error => {
                    commit('UNSET_AUTH');
                    reject(error);
                });
        });
    },
    logout({commit}) {
        axios.post('/auth/logout').then(() => {
            commit('UNSET_AUTH');
            window.location.reload();
        })
    },
    getAuth({commit}) {
        return new Promise((resolve, reject) => {
            if (state.isAuth) {
                axios.get('/auth')
                    .then(response => {
                        commit('SET_USER', response.data.user);
                        commit('SET_API_TOKEN', response.data.user.apiToken);
                        resolve(response);
                    })
                    .catch(error => {
                        commit('UNSET_AUTH');
                        router.push({name: 'Login'})
                            .catch(() => {
                                // such emptiness
                            })

                        reject(error);
                    });
            } else {
                commit('UNSET_AUTH')
            }
        });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
