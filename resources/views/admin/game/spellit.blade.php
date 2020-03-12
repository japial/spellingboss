@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="float-left"> Spell It Spellers</strong>
                    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#dataModal" @click="resetFormData">
                        Create
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="!dataLoaded" class="content-loader"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Speller</th>
                                <th>Round</th>
                                <th>Words</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in allData" :key="index">
                                <td v-text="item.speller"></td>
                                <td v-text="item.round"></td>
                                <td>
                                    <strong v-for="(spword, index) in item.words" :key="index">
                                        <span v-if="spword.correct" class="badge badge-success ml-2"  v-text="spword.details.word"></span>
                                        <span v-else class="badge badge-light ml-2"  v-text="spword.details.word"></span>
                                    </strong>
                                    
                                </td>
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#dataModal" 
                                            @click="editData(index)">Edit</button>
                                    <button class="btn btn-danger ml-2" @click="deleteData(item.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalTitle">Speller</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Round</label>
                    <select v-model="round"  class="form-control">
                        <option value="0">Select Round</option>
                        <option v-for="(item, index) in rounds" :key="index" :value="item.id" v-text="item.name"></option>
                    </select>
                    <div v-html="showValidationError(vErrors.round)"></div>
                </div>
                <div class="form-group">
                    <label>Spellers</label>
                    <select v-model="user"  class="form-control">
                        <option value="0">Select Speller</option>
                        <option v-for="(item, index) in spellers" :key="index" :value="item.id" v-text="item.name"></option>
                    </select>
                    <div v-html="showValidationError(vErrors.user)"></div>
                </div>
                <div class="form-group">
                    <label>Words</label>
                    <select multiple class="form-control"  v-model="spellWords" >
                        <option v-for="(sword, index) in words" :key="index" :value="sword.id"  v-text="sword.word"></option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-if="updateID" @click="updateData">Update</button>
                <button type="button" class="btn btn-primary" v-else @click="createData">Create</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/admin/spellusers.js') }}"></script>
@endpush





