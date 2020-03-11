/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* global axios, Swal */

const app = new Vue({
    el: '#app',
    data() {
        return {
            dataLoaded: false,
            vErrors: [],
            allData: [],
            spellers: [],
            rounds: [],
            words: [],
            updateID: 0,
            user: 0,
            round: 0,
            spellWords: [],
            correct: 0,
            reqUrl: '/admin/spellusers'
        };
    },
    mounted: function () {
        this.getAllData();
        this.getAllSpellers();
    },
    methods: {
        getAllSpellers() {
            axios.get('/admin/spelluser-info').then(response => {
                this.spellers = response.data.spellers;
                this.words = response.data.words;
                this.rounds = response.data.rounds;
            }).catch(error => {
                console.log(error);
            });
        },
        getAllData() {
            this.dataLoaded = false;
            axios.get(this.reqUrl).then(response => {
                this.allData = response.data;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.dataLoaded = true);
        },
        createData() {
            axios.post(this.reqUrl, {
                user : this.user ,
                round : this.round ,
                word: this.word 
            }).then(response => {
                this.resetFormData();
                this.allData = response.data;
                $('#dataModal').modal('toggle');
                this.successAlert('Spellit User Created!');
            }).catch(error => {
                this.vErrors = error.response.data.errors;
            });
        },
        editData(index) {
            let updateData = this.allData[index];
            if (updateData) {
                this.updateID = updateData.id;
                this.user = updateData.user_id;
                this.round = updateData.round_id;
                this.word = updateData.spellit_id;
                this.correct = updateData.correct;
            }
        },
        updateData() {
            axios.put(this.reqUrl + '/' +this.updateID, {
                user : this.user ,
                round : this.round ,
                word: this.word, 
                correct: this.correct 
            }).then(response => {
                this.resetFormData();
                if(response.data) {
                   this.allData = response.data;
                }
                $('#dataModal').modal('toggle');
                this.successAlert('Spellit User Updated!');
            }).catch(error => {
                console.log(error);
            });
        },
        deleteData(itemID) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete(this.reqUrl + '/' + itemID).then(response => {
                        if (response.data) {
                            this.allData = response.data;
                        }
                        this.successAlert('Spellit User Deleted!');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            });
        },
        resetFormData() {
            this.user_id = 0;
            this.round_id = 0;
            this.spellit_id = 0;
            this.correct = 0;
            this.vErrors = false;
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