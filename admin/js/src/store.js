import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
	state: {
		trailsData: []
	},
	getters: {
		trailsData(state) {
			return state.trailsData;
		}
	},
	mutations: {
		updateTrailsData(state, payload) {
			state.trailsData = payload;
		},
		addTrail(state, payload) {
			state.trailsData.push(payload);
		},
		changeAllTrailStatuses(state, status) {
			for (let i = 0; i < state.trailsData.length; i++) {
				state.trailsData[i].status = status;
			}
		},
		removeTrail(state, index) {
			state.trailsData.splice(index, 1);
		}
	}
});