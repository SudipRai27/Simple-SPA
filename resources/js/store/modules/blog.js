import axios from "axios";

const blog = {
    namespaced: true,
    state: () => ({
        blogs: []
    }),
    mutations: {
        SET_BLOGS(state, payload) {
            state.blogs = payload;
        },
        ADD_BLOG(state, payload) {
            state.blogs.unshift(payload);
        },
        UPDATE_BLOG(state, payload) {
            state.blogs = state.blogs.map(blog =>
                blog.id === payload.id ? payload : blog
            );
        },
        REMOVE_BLOG(state, payload) {
            // payload is the blog id
            state.blogs = state.blogs.filter(blog => blog.id != payload);
        }
    },
    actions: {
        fetchBlogs({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/blogs")
                    .then(res => {
                        commit("SET_BLOGS", res.data.data);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        createBlog({ commit }, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/blogs/create", payload, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        commit("ADD_BLOG", res.data.data);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        getSingleBlog({ commit }, payload) {
            // payload is the blog id
            return new Promise((resolve, reject) => {
                axios
                    .get(`/api/blogs/edit/${payload}`)
                    .then(res => {
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        // payload is the FormData
        updateBlog({ commit }, payload) {
            const id = payload.get("blogId");
            return new Promise((resolve, reject) => {
                axios
                    .post(`/api/blogs/update/${id}`, payload, {
                        headers: {
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        commit("UPDATE_BLOG", res.data.data);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        deleteBlog({ commit }, payload) {
            //payload is the blog id
            return new Promise((resolve, reject) => {
                axios
                    .delete(`/api/blogs/delete/${payload}`)
                    .then(res => {
                        commit("REMOVE_BLOG", payload);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        }
    },
    getters: {
        getAllBlogs(state) {
            return state.blogs;
        }
    }
};

export default blog;
