/* eslint-disable */
import API from '@/api';
// noinspection all
const actions = {
	index({commit, rootGetters }, data) {
		API.questions.index(data).then(({data}) => {
			commit('index', data);
		});
	},
	show({commit}, payload) {
		commit('show', payload);
	},
	create({commit, dispatch, state}, payload) {
		return new Promise((resolve, reject) => {
			API.questions.create(payload).then(data => {
				dispatch('index', state.search);
				resolve(data);
			}).catch(err => {
				reject(err);
			});
		});
	},
	update({commit, dispatch, state}, payload) {
		API.questions.update(payload).then(() => {
      dispatch('index', state.search);
      dispatch('show', payload['id']);
			dispatch('index');
		});
	},
	destroy({commit, dispatch, state}, id) {
		API.questions.destroy(id).then(() => {
			dispatch('index', state.search);
		});
	},
};

export default actions;
