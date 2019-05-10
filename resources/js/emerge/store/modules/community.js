import Vue from "vue";
export const SET_ACCENT_COLOR = "SET_ACCENT_COLOR";
export const DEFAULT_ACCENT_COLORS = {
    light: "#EDFAF5",
    dark: "#60d9a7"
};

export default {
    state: {
        accentColor: DEFAULT_ACCENT_COLORS
    },
    getters: {
        communityAccentLight({ accentColor }) {
            return accentColor.light;
        },

        communityAccentDark({ accentColor }) {
            return accentColor.dark;
        }
    },
    mutations: {
        [SET_ACCENT_COLOR](state, obj) {
            state.accentColor.dark = obj.dark;
            state.accentColor.light = obj.light;
        }
    }
};
