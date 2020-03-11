@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="float-left"> Rounds</strong>
                    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#dataModal" @click="resetFormData">
                        Create
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="!dataLoaded" class="content-loader"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Finished</th>
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
                <h5 class="modal-title" id="dataModalTitle">Round</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Word</label>
                    <input type="text" class="form-control" v-model="name"  placeholder="Enter Name">
                    <div v-html="showValidationError(vErrors.name)"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h6>Finished:</h6>
                    </div>
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="finished" name="role" value="0">
                            <label class="form-radio-label">No</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="finished" name="role" value="1">
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
<script src="{{ asset('assets/admin/rounds.js') }}"></script>
@endpush




