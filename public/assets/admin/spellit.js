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
            speller: '',
            round: '',
            words: [],
            timer: null,
            totalTime: 60,
            resetButton: false,
            selectedWord: 0
        };
    },
    mounted: function () {
        this.getSpellersWords();
    },
    methods: {
        getSpellersWords() {
            this.dataLoaded = false;
            axios.get('/admin/spellit-game-info/' + spellUserID).then(response => {
                this.speller = response.data.speller;
                this.words = response.data.words;
                this.round = response.data.round;
            }).catch(error => {
                console.log(error);
            }).finally(this.dataLoaded = true);
        },
        startTimer: function () {
            this.timer = setInterval(() => this.countdown(), 1000);
            this.resetButton = true;
            this.title = "Greatness is within sight!!"
        },
        stopTimer: function () {
            clearInterval(this.timer);
            this.timer = null;
            this.resetButton = true;
            this.title = "Never quit, keep going!!"
        },
        resetTimer: function () {
            this.totalTime = 60;
            clearInterval(this.timer);
            this.timer = null;
            this.resetButton = false;
            this.title = "Let the countdown begin!!"
        },
        padTime: function (time) {
            return (time < 10 ? '0' : '') + time;
        },
        countdown: function () {
            if (this.totalTime >= 1) {
                this.totalTime--;
            } else {
                this.totalTime = 0;
                this.resetTimer()
            }
        }
    },
    computed: {
        minutes: function () {
            const minutes = Math.floor(this.totalTime / 60);
            return this.padTime(minutes);
        },
        seconds: function () {
            const seconds = this.totalTime - (this.minutes * 60);
            return this.padTime(seconds);
        }
    }

});
