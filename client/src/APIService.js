import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000';

export class APIService {
    constructor() {

    }

    getCustomers() {
        const url = 'http://127.0.0.1:8000/customer';
        return axios.get(url).then(response => response.data)
    }

    getCustomer() {
        const url = '${API_URL}/customer/${id}';
        return axios.get(url).then(response => response.data)
    }
}