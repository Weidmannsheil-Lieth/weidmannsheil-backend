import axios from "../../axios";

const state = {
    mailReceiverGroups: [],
};

const getters = {
    mailReceiverGroups: (state) => state.mailReceiverGroups
};

const mutations = {
    SET_MAIL_RECEIVER_GROUPS(state, mailReceiverGroups) {
        state.mailReceiverGroups = mailReceiverGroups
    }
};

const actions = {
    getMailReceiverGroups({commit}) {
        return new Promise((resolve, reject) => {
            axios.get('/mail-receiver-groups')
                .then(response => {
                    commit('SET_MAIL_RECEIVER_GROUPS', response.data.data);
                    resolve(response);
                })
                .catch(error => {
                    reject(error);
                });
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
