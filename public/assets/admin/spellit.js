/* global axios, Swal */

const app = new Vue({
    el: '#app',
    data() {
        return {
            wordsData: false,
            vErrors: [],
            word: '',
            definition: '',
            bangla: '',
            sentence: '',
            wordType: 'noun',
            allWords: [],
            updateID: 0
        };
    },
    mounted: function () {
        this.getAllWords();
    },
    methods: {
        getAllWords() {
            this.wordsData = false;
            axios.get('/admin/spellits').then(response => {
                this.allWords = response.data;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.wordsData = true);
        },
        createWord() {
            axios.post('/admin/spellits', {
                word: this.word,
                definition: this.definition,
                bangla: this.bangla,
                sentence: this.sentence,
                type: this.wordType
            }).then(response => {
                this.resetWordFormData();
                this.allWords.push(response.data);
                $('#wordModal').modal('toggle');
                this.successAlert('Word Created!');
            }).catch(error => {
                this.vErrors = error.response.data.errors;
            });
        },
        editWord(index) {
            let updateData = this.allWords[index];
            if (updateData) {
                this.updateID = updateData.id;
                this.word = updateData.word;
                this.definition = updateData.definition;
                this.bangla = updateData.bangla;
                this.sentence = updateData.sentence;
                this.wordType = updateData.type;
            }
        },
        updateWord() {
            axios.put('/admin/spellits/' + this.updateID, {
                word: this.word,
                definition: this.definition,
                bangla: this.bangla,
                sentence: this.sentence,
                type: this.wordType
            }).then(response => {
                if (response.data) {
                    this.allWords = response.data;
                }
                $('#wordModal').modal('toggle');
                this.successAlert('Word Updated!');
            }).catch(error => {
                console.log(error);
            });
        },
        deleteWord(wordID) {
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
                    axios.delete('/admin/spellits/' + wordID).then(response => {
                        if (response.data) {
                            this.allWords = response.data;
                        }
                        this.successAlert('Word Deleted!');
                    }).catch(error => {
                        console.log(error);
                    });
                }
            });
        },
        resetWordFormData() {
            this.word = '';
            this.definition = '';
            this.bangla = '';
            this.sentence = '';
            this.wordType = 'noun';
            this.validationError = false;
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