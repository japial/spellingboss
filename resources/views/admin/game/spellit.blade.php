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
                                <td v-text="item.name"></td>
                                <td>
                                    <span v-if="item.finished == 1" class="badge badge-success">YES</span>
                                    <span v-else class="badge badge-info">NO</span>
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
                        <option v-for="(user, index) in rounds" :key="index" :value="round.id" v-text="round.name"></option>
                    </select>
                    <div v-html="showValidationError(vErrors.round)"></div>
                </div>
                <div class="form-group">
                    <label>Spellers</label>
                    <select v-model="user"  class="form-control">
                        <option v-for="(user, index) in spellers" :key="index" :value="user.id" v-text="user.name"></option>
                    </select>
                    <div v-html="showValidationError(vErrors.user)"></div>
                </div>
                <div class="form-group">
                    <label>Words</label>
                    <select multiple class="form-control"  v-model="spellWords" >
                        <option v-for="(sword, index) in words" :key="index"  v-text="sword.word"></option>
                    </select>
                </div>
                <div class="row" v-if="updateID">
                    <div class="col">
                        <h6>Correct:</h6>
                    </div>
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="correct" name="role" value="0">
                            <label class="form-radio-label">No</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="correct" name="role" value="1">
                            <label class="form-radio-label">YES</label>
                        </div>
                    </div>     
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





