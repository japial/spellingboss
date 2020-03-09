/* global axios, Swal */

const app = new Vue({
    el: '#app',
    data() {
        return {
            usersData: false,
            validationError: false,
            errors: [],
            userName: '',
            userEmail: '',
            userPassword: '',
            userRole: 'speller',
            allUsers:[],
            updateID:'',
        };
    },
    mounted: function () {
        this.getAllUsers();
    },
    methods: {
        getAllUsers() {
            this.usersData = false;
            axios.get('/admin/users').then(response => {
                this.allUsers = response.data;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.usersData = true);
        },
        createNewUser() {
            axios.post('/admin/users', {
                    name: this.userName,
                    email: this.userEmail,
                    password: this.userPassword,
                    user_type: this.userRole
                }
            ).then(response => {
                this.resetUserFormData();
                this.allUsers.push(response.data);
                $('#addUserModal').modal('toggle');
                this.successAlert('User Created!');
            }).catch(error => {
                this.validationError = true;
                this.errors = error.response.data.errors;
            });
        },
        editUser(userID){
            this.updateID = userID;
            axios.get('/admin/users/'+userID+'/edit').then(response => {
                if(response.data){
                    this.userName = response.data.name;
                    this.userEmail = response.data.email;
                    this.userRole = response.data.user_type;
                }
            }).catch(error => {
                console.log(error);
            });
        },
        updateUserInfo(){
             axios.put('/admin/users/'+this.updateID,{
                   name: this.userName,
                   email: this.userEmail,
                   password: this.userPassword,
                   user_type: this.userRole
             }).then(response => {
                if(response.data){
                    this.allUsers = response.data;
                }
                $('#editUserModal').modal('toggle');
                this.successAlert('User Updated!');
            }).catch(error => {
                console.log(error);
            });
        },
        deleteUser(userID){
             axios.delete('/admin/users/'+userID).then(response => {
                if(response.data){
                    this.allUsers = response.data;
                }
                this.successAlert('User Deleted!');
            }).catch(error => {
                console.log(error);
            });
        },
        resetUserFormData(){
            this.userName = '';
            this.userEmail = '';
            this.userPassword = '';
            this.userRole = 'speller';
            this.validationError = false;
        },
        showValidationError(errorField = ''){
            let errorElement = '';
            if(errorField.length){
                for(let k in errorField){
                    errorElement += `<small class="form-text text-danger d-block p-1">${errorField[k]}</small>`;
                }
            }
            return errorElement;
        },
        successAlert(message){
           Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: message,
            showConfirmButton: false,
            timer: 1500
          });
        }
    }
});