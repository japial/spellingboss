<div id="timer-clock">
    <span class="minute" v-text="minutes"></span>
    <span class="colon">:</span>
    <span class="second" v-text="seconds"></span>
</div>
<div id="timer-buttons">
    <!--     Start TImer -->
    <button 
        id="start" 
        class="btn btn-info" 
        v-if="!timer"
        @click="startTimer">
        Play
    </button>
    <!--     Pause Timer -->
    <button 
        id="stop" 
        class="btn btn-warning" 
        v-if="timer"
        @click="stopTimer">
        Pause
    </button>
    <!--     Restart Timer -->
    <button 
        id="reset" 
        class="btn btn-secondary" 
        v-if="resetButton"
        @click="resetTimer">
        Restart
    </button>
</div>


