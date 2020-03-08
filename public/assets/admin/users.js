/* global axios */

const app = new Vue({
    el: '#app',
    data() {
        return {
            usersData: false,
            userName: '',
            userEmail: '',
            userPassword: '',
            userRole: 'speller',
            allUsers:[]
        };
    },
    mounted: function () {
        this.getAllUsers();
    },
    methods: {
        getAllUsers() {
            this.usersData = false;
            axios.get('/admin/all-users').then(response => {
                this.allUsers = response.data;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.usersData = true);
        },
        createNewUser() {
            this.usersData = false;
            axios.post('/admin/users/store', {
                    name: this.userName,
                    email: this.userEmail,
                    password: this.userPassword,
                    user_type: this.userRole
                }
            ).then(response => {
                this.resetUserFormData();
                this.allUsers.push(response.data);
                $('#addUserModal').modal('toggle');
            }).catch(error => {
                console.log(error);
            }).finally(() => this.usersData = true);
        },
        resetUserFormData(){
            this.userName = '';
            this.userEmail = '';
            this.userPassword = '';
            this.userRole = 'speller';
        }
    }
});