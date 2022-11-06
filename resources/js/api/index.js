import axios from "axios";

const API_URL = "http://localhost:8000/api/";

const instance = axios.create({
    baseURL: API_URL,
});

async function getRequest(url, token) {
    const data = await instance.get(url, {
        headers: { Authorization: "Bearer " + token },
    });
    return data;
}

async function postRequest(url, data, token) {
    const post = await instance.post(
        url,
        data,
        {
            headers: { Authorization: "Bearer " + token }
        }
    );
    return post;
}

export { getRequest, postRequest };
