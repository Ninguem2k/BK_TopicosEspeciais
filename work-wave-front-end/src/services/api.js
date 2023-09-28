import axios from "axios";

const api = axios.create({
    baseURL: "http://3.87.14.182:3333",
});

export default api;
