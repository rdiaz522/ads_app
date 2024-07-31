import AuthService from '@/services/auth.service';
import SessionService from '@/services/session.service';
import sessionConfig from "@/config/sessions";

const Sessions = {
    namespaced: true,

    state: () => ({
        sessionTimeLeft: 1,
        loginTime: 0,
        duration: 0,
        intervalId: null,
        modalInstance: null

    }),

    getters: {
        sessionTimeLeft: state => state.sessionTimeLeft,
    },

    mutations: {
        SET_DURATION(state, duration) {
            state.duration = duration;
        },

        SET_SESSION_TIME_LEFT(state, time) {
          state.sessionTimeLeft = time;
        },

        SET_LOGIN_TIME(state, time) {
          state.loginTime = time;
        },

        COUNTDOWN(state, endTime) {
            const currentTime = Math.floor(Date.now() / 1000);
            const sessionTimeLeft = endTime - currentTime;
            state.sessionTimeLeft = sessionTimeLeft;
        },

        SET_INTERVAL_ID(state, intervalId) {
            state.intervalId = intervalId;
        },

        CLEAR_INTERVAL_ID(state) {
            if (state.intervalId) {
                clearInterval(state.intervalId);
                state.intervalId = null;
            }
        },

        SHOW_SESSION_MODAL(state) {
            state.modalInstance.show();
        },

        HIDE_SESSION_MODAL(state) {
            state.modalInstance.hide()
        },

        SET_MODAL_INSTANCE(state, modalInstance) {
            state.modalInstance = modalInstance;
        },
    },

    actions: {
        startTimer({state, commit, dispatch}) {
            if (sessionConfig.duration && !isNaN(sessionConfig.duration)) {

                commit('SET_DURATION', sessionConfig.duration);
                commit('CLEAR_INTERVAL_ID');

                if (state.sessionTimeLeft <= sessionConfig.refreshTokenTimeLeft) {
                    commit('SET_LOGIN_TIME', Math.floor(Date.now() / 1000));
                }

                const endTime = state.loginTime + state.duration;

                const intervalId = setInterval(() => {
                    dispatch('decrementTime', endTime);
                }, 1000);

                commit('SET_INTERVAL_ID', intervalId);
            }

        },

        decrementTime({commit, dispatch, state}, endTime) {
            if (state.sessionTimeLeft > 0) {
                commit('COUNTDOWN', endTime);
                if (state.sessionTimeLeft === sessionConfig.popModalTime) {
                    commit('SHOW_SESSION_MODAL');
                }
            } else {
                commit('CLEAR_INTERVAL_ID');
                commit('HIDE_SESSION_MODAL');
                dispatch('userLogout');
            }
        },

        stopTimer({commit}) {
            commit('CLEAR_INTERVAL_ID');
            commit('SET_DURATION', 0);
            commit('SET_SESSION_TIME_LEFT', 1);
            commit('SET_LOGIN_TIME', 0);
            commit('SET_MODAL_INSTANCE', null);

        },

        getModalRefs({commit}, refs) {
            if (refs) {
                const modalElement = refs.sessionModal;
                const modalInstance = new bootstrap.Modal(modalElement);
                commit('SET_MODAL_INSTANCE', modalInstance);
            }
        },

        async userLogout() {
            try {
                await AuthService.userLogout();
                SessionService.logoutSession();
                this.$router.push({name: 'login'});
            } catch (error) {
                console.log(error);
            }
        }
    },
};

export default Sessions;
