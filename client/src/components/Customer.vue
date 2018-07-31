<template>
    <div class="container-fluid mt-4">
        <h1>Customers</h1>
        <b-alert :show="loading" variant="info">Loading...</b-alert>
        <b-row>
            <b-col>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>CPF</th>
                        <th>Birthday</th>
                        <th>Genre</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in customers" :key="customer.id">
                        <th>{{ customer.id }}</th>
                        <td>{{ customer.firstName }}</td>
                        <td>{{ customer.lastName }}</td>
                        <td>{{ customer.cpf }}</td>
                        <td>{{ getDateFromBday(customer.birthday)}}</td>
                        <td>{{ customer.genre }}</td>
                        <td>
                            <button class="btn btn-info" @click.prevent="populateCustomerToEdit(customer)">Edit</button>
                            <button class="btn btn-danger" @click.prevent="deleteCustomer(customer.id)">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </b-col>
            <b-col lg="3">
                <b-card :title="(model.id ? 'Edit Customer ID#' + model.id : 'New Customer')">
                    <form @submit.prevent="saveCustomer">
                        <b-form-group label="First Name">
                            <b-form-input type="text" v-model="model.firstName" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Last Name">
                            <b-form-input type="text" v-model="model.lastName" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="CPF">
                            <b-form-input type="text" v-model="model.cpf" v-mask="'XXX.XXX.XXX-XX'" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Birthday">
                            <b-form-input type="text" v-model="model.birthday" v-mask="'XX/XX/XXXX'" required></b-form-input>
                        </b-form-group>
                        <b-form-group label="Genre">
                            <b-form-select v-model="model.genre" required>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </b-form-select>
                        </b-form-group>
                        <div>
                            <b-btn type="submit" variant="success">Save</b-btn>
                        </div>
                    </form>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
    import api from '@/APIService';
    import {mask} from 'vue-the-mask'

    export default {
        directives: {mask},
        name: 'Customer',
        components: {},
        data() {
            return {
                loading: false,
                customers: [],
                model: {}
            };

        },
        created () {
            this.refreshPosts()
        },
        methods: {
            refreshPosts () {
                this.loading = true
                this.customers = api.getCustomers().then(data => {
                    if(parseInt(Object.keys(data)[0]) === 200) {
                        this.customers = data[Object.keys(data)[0]]
                    } else {
                        alert('Error when tried get customers')
                    }
                });
                this.loading = false
            },
            populateCustomerToEdit (customer) {
                this.model = Object.assign({}, customer)
                this.model.birthday = this.getDateFromBday(customer.birthday)
            },
            saveCustomer () {
                if (this.model.id) {
                    api.editCustomer(this.model)
                } else {
                    api.addCustomer(this.model)
                }
                this.model = {}
                this.refreshPosts()
            },
            deleteCustomer(id) {
                if (confirm('Are you sure you want to delete this customer?')) {
                    if (this.model.id === id) {
                        this.model = {}
                    }
                    api.deleteCustomer(id)
                    let self = this;
                    setTimeout(function(){
                        self.refreshPosts()
                    }, 1000);
                }
            },
            getDateFromBday(bday) {
                for (var prop in bday) {
                    if (prop == 'date') {
                        return this.formatDate(new Date(bday[prop]));
                    }
                }
            },
            formatDate(date) {
                let day = date.getDate() < 10 ? ("0" + date.getDate()).slice(-2) : date.getDate();
                let month = (date.getMonth() + 1) < 10 ? ("0" + (date.getMonth() + 1)).slice(-2) : date.getMonth();
                return day +'/'+(month)+'/'+date.getFullYear();
            }
        },
//        mounted() {
//            this.getCustomers();
//        },
    }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
    h1, h2 {
        font-weight: normal;
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    li {
        display: inline-block;
        margin: 0 10px;
    }
    a {
        color: #42b983;
    }
</style>
