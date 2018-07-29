import Vue from 'vue'
import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/';

export default {
    getCustomers() {
        let url =  API_URL + 'customer';
        return axios.get(url).then(response => response.data);
    },
    getCustomer(id) {
        let url = API_URL + 'customer/' + id;
        return axios.get(url).then(response => response.data);
    },
    addCustomer(customer) {
        let url =  API_URL + 'customer';
        return axios.post(url, customer);
    },
    editCustomer(customer) {
        let url =  API_URL + 'customer/' + customer.id;
        return axios.put(url, customer);
    },
    deleteCustomer(id) {
        let url =  API_URL + 'customer/' + id;
        return axios.delete(url);
    }
}