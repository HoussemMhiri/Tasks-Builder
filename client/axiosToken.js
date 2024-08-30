import axios from "axios";

// Create an Axios instance
const instance = axios.create({
  baseURL: "http://localhost:8000",
});

// Request interceptor to add headers
instance.interceptors.request.use(
  (config) => {
    const token = JSON.parse(localStorage.getItem("userToken"));
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
      config.headers["Accept"] = "application/json";
    }
    return config;
  },
  (error) => Promise.reject(error)
);

export default instance;
