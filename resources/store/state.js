import {defineStore} from "pinia";

export const useState = defineStore('state', {
    state: () => ({
        states: {
            loading: false,
        },
    }),

    getters: {
        get: (state) => {
            return (...keys) => !!state.states[keys.join('_')]
        }
    },

    actions: {
        set(...keys) {
            this.states[keys.join('_')] = true
        },

        unset(...keys) {
            this.states[keys.join('_')] = false
        }
    },
})

