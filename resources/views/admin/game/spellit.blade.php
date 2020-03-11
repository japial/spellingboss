@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="float-left"> Spell It Game</strong>
                    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#wordModal">
                        Add User Word
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="!wordsData" class="content-loader"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Word</th>
                                <th>Definition</th>
                                <th>Bangla</th>
                                <th>Sentence</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(spell, index) in allWords" :key="index">
                                <td v-text="spell.word"></td>
                                <td v-text="spell.definition"></td>
                                <td v-text="spell.bangla"></td>
                                <td v-text="spell.sentence"></td>
                                <td v-text="spell.type"></td>
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#wordModal" 
                                            @click="editWord(index)">Edit</button>
                                    <button class="btn btn-danger ml-2" @click="deleteWord(spell.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="wordModal" tabindex="-1" role="dialog" aria-labelledby="wordModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Word</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Word</label>
                    <input type="text" class="form-control" v-model="word"  placeholder="Enter Word">
                    <div v-html="showValidationError(vErrors.word)"></div>
                </div>
                <div class="form-group">
                    <label>Definition</label>
                    <input type="text" class="form-control" v-model="definition"  placeholder="Enter Definition">
                    <div v-html="showValidationError(vErrors.definition)"></div>
                </div>
                <div class="form-group">
                    <label>Bangla Meaning</label>
                    <input type="text" class="form-control" v-model="bangla"  placeholder="Enter Bangla Meaning">
                    <div v-html="showValidationError(vErrors.bangla)"></div>
                </div>
                <div class="form-group">
                    <label>Sentence</label>
                    <input type="text" class="form-control" v-model="sentence"  placeholder="Enter Sentence">
                    <div v-html="showValidationError(vErrors.sentence)"></div>
                </div>
                <div class="form-group">
                    <label>Word Type</label>
                    <select v-model="wordType" class="form-control">
                        <option value="noun">Noun</option>
                        <option value="pronoun">Pronoun</option>
                        <option value="verb">verb</option>
                        <option value="adjective">Adjective</option>
                        <option value="adverb">Adverb</option>
                        <option value="preposition">Preposition</option>
                        <option value="conjunction">Conjunction</option>
                        <option value="interjection">Interjection</option>
                    </select>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-if="updateID" @click="updateWord">Update</button>
                <button type="button" class="btn btn-primary" v-else @click="createWord">Create</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/admin/spellit.js') }}"></script>
@endpush



