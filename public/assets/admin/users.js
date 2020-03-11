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
            allUsers: [],
            updateID: 0,
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
        editUser(index) {
            let updateData = this.allUsers[index];
            if(updateData){
                this.updateID = updateData.id;
                this.userName = updateData.name;
                this.userEmail = updateData.email;
                this.userRole = updateData.user_type;
            }
        },
        updateUserInfo() {
            axios.put('/admin/users/' + this.updateID, {
                name: this.userName,
                email: this.userEmail,
                password: this.userPassword,
                user_type: this.userRole
            }).then(response => {
                if (response.data) {
                    this.allUsers = response.data;
                }
                $('#editUserModal').modal('toggle');
                this.successAlert('User Updated!');
                this.resetUserFormData();
            }).catch(error => {
                console.log(error);
            });
        },
        deleteUser(userID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/admin/users/' + userID).then(response => {
                        if (response.data) {
                            this.allUsers = response.data;
                        }
                        this.successAlert('User Deleted!');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            });
        },
        resetUserFormData() {
            this.userName = '';
            this.userEmail = '';
            this.userPassword = '';
            this.userRole = 'speller';
            this.validationError = false;
            this.errors = [];
            this.updateID = 0;
        },
        showValidationError(errorField = '') {
            let errorElement = '';
            if (errorField.length) {
                for (let k in errorField) {
                    errorElement += `<small class="form-text text-danger d-block p-1">${errorField[k]}</small>`;
                }
            }
            return errorElement;
        },
        successAlert(message = '') {
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