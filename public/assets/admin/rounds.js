/* global axios, Swal */

const app = new Vue({
    el: '#app',
    data() {
        return {
            dataLoaded: false,
            vErrors: [],
            allData: [],
            updateID: 0,
            name: '',
            finished: 0,
            reqUrl: '/admin/rounds'
        };
    },
    mounted: function () {
        this.getAllData();
    },
    methods: {
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
                name: this.name,
                finished: this.finished
            }).then(response => {
                this.resetFormData();
                this.allData.push(response.data);
                $('#dataModal').modal('toggle');
                this.successAlert('Round Created!');
            }).catch(error => {
                this.vErrors = error.response.data.errors;
            });
        },
        editData(index) {
            let updateData = this.allData[index];
            if (updateData) {
                this.updateID = updateData.id;
                this.name = updateData.name;
                this.finished = updateData.finished;
            }
        },
        updateData() {
            axios.put(this.reqUrl + '/' +this.updateID, {
                name: this.name,
                finished: this.finished
            }).then(response => {
                this.resetFormData();
                if(response.data) {
                   this.allData = response.data;
                }
                $('#dataModal').modal('toggle');
                this.successAlert('Round Updated!');
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
                        this.successAlert('Round Deleted!');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            });
        },
        resetFormData() {
            this.name = '';
            this.finished = 0;
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