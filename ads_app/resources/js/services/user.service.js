import api from "@/services/api";

class UserService {
    getUsers() {
        return api.get("/users");
    }

    createUser(data) {
        return api.post("/users", data);
    }

    updateUser(id, data) {
        return api.post(`/users/update/${id}`, data);
    }

    getUserById(id) {
        return api.get(`/users/${id}`);
    }

    getUserDataTable() {
        return api.get("/users/datatable");
    }
}

export default new UserService();
