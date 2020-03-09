@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="float-left"> List of Users</strong>
                    <button class="btn btn-dark float-right" data-toggle="modal" data-target="#addUserModal">
                        Add User
                    </button>
                </div>
                <div class="card-body">
                    <div v-if="!usersData" class="content-loader"></div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in allUsers" :key="index">
                                <td v-text="user.name"></td>
                                <td v-text="user.email"></td>
                                <td v-text="user.user_type.toUpperCase()"></td>
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editUserModal" 
                                            @click="editUser(user.id)">Edit</button>
                                    <button class="btn btn-danger ml-2" @click="deleteUser(user.id)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalTitle">Create New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="userName"  placeholder="Enter Name">
                    <div v-if="validationError" v-html="showValidationError(errors.name)"></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" v-model="userEmail"  placeholder="Enter email">
                    <div v-if="validationError" v-html="showValidationError(errors.email)"></div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" v-model="userPassword" placeholder="Password">
                    <div v-if="validationError" v-html="showValidationError(errors.password)"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="speller">
                            <label class="form-radio-label">Speller</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="admin">
                            <label class="form-radio-label">Admin</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="host">
                            <label class="form-radio-label">Host</label>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="createNewUser">Create</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="userName"  placeholder="Enter Name">
                    <div v-if="validationError" v-html="showValidationError(errors.name)"></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" v-model="userEmail"  placeholder="Enter email">
                    <div v-if="validationError" v-html="showValidationError(errors.email)"></div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" v-model="userPassword" placeholder="Password">
                    <div v-if="validationError" v-html="showValidationError(errors.password)"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="speller">
                            <label class="form-radio-label">Speller</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="admin">
                            <label class="form-radio-label">Admin</label>
                        </div>
                    </div>   
                    <div class="col">
                        <div class="form-radio">
                            <input type="radio" class="form-radio-input" v-model="userRole" name="role" value="host">
                            <label class="form-radio-label">Host</label>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="updateUserInfo">Update</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/admin/users.js') }}"></script>
@endpush

