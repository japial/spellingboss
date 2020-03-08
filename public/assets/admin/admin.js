/* global axios */

const app = new Vue({
    el: '#appInstructor',
    data() {
        return {
            noticeData: false,
            courseReport:[]
        };
    },
    mounted: function () {
        this.getNotices();
    },
    methods: {
        getMyRoutine() {
            this.myRoutineData = false;
            axios.get('/main/teacher/my_routines', {
                params: {course: this.myRoutineCourse, date_filter: this.myRoutineFilter}
            }).then(response => {
                let result = response.data;
                this.myRoutines = result.routines;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.myRoutineData = true);
        },
        getRoutines() {
            this.routineData = false;
            axios.get('/main/teacher/routines', {
                params: {course: this.routineCourse, date_filter: this.routineFilter}
            }).then(response => {
                let result = response.data;
                this.routines = result.routines;
            }).catch(error => {
                console.log(error);
            }).finally(() => this.routineData = true);
        },
        validString(item) {
            if (item && item.length) {
                return true;
            } else {
                return false;
            }
        },
        word_limit(content, limit) {
            if (content.length) {
                let wordList = content.split(" ");
                if (wordList.length > limit) {
                    let newContent = '';
                    for (let i = 0; i <= limit; i++) {
                        newContent += ' ' + wordList[i];
                    }
                    newContent += '...';
                    content = newContent;
                }
                return content;
            } else {
                return 'No Content';
            }
        }
    }
});