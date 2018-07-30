import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000';

export default {
    getCustomers() {
        let url =  API_URL + '/customer';
        return axios.get(url).then(response => response.data);
    },
    addCustomer(data) {
        let url = API_URL + '/customer';
        let data2 = new FormData();
        data2.append('firstName', data.firstName);
        data2.append('lastName', data.lastName);
        data2.append('cpf', data.cpf);
        data2.append('birthday', (data.birthday != null) ? data.birthday.split('/').reverse().join('-') : null);
        data2.append('genre', data.genre);
        return axios.post(url, data2).then(response => console.log(response.data)).catch(error => console.log(error));
    },
    editCustomer(data) {
        let url = API_URL + '/customer/' + data.id;
        let data2 = new FormData();
        data2.append('firstName', data.firstName);
        data2.append('lastName', data.lastName);
        data2.append('cpf', data.cpf);
        data2.append('birthday', (data.birthday != '' || data.birthday != null) ? data.birthday.split('/').reverse().join('-') : null);
        data2.append('genre', data.genre);
        data2.append('_method', 'PUT');
        return axios.post(url, data2).then(response => console.log(response.data)).catch(error => console.log(error));
    },
    deleteCustomer(id){
        let url =  API_URL + '/customer/' + id;
        return axios.delete(url);
    }
}
