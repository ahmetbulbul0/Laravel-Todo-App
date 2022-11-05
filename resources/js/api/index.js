import axios from "axios";

const API_URL = "http://localhost:8000/api/";

const instance = axios.create({
    baseURL: API_URL
});

async function getRequest(url) {
  const data = await instance.get(url);
  return data;
}

export { getRequest };
