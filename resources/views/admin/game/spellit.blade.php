@extends('layouts.app')
@push('styles')
   <link href="{{ asset('assets/lib/timer.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="w-50 float-left">
                         <strong class="width33" v-text="speller"></strong>
                    </div>
                    <div class="w-50 float-left text-right">
                        <strong>Spell It - </strong>
                        <strong v-text="round"></strong>
                    </div>
                </div>
                <div class="card-body">
                    <div v-if="!dataLoaded" class="content-loader"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <span class="d-block">Word:</span>
                            <h3 v-if="words.length" v-text="words[selectedWord].word"></h3>
                        </div>
                        <div class="col-md-6">
                            @include('admin.game.timer')
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success mt-2 float-left">Correct</button>
                            <button class="btn btn-danger mt-2 float-right">Wrong</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                        </div>
                        <div class="col-md-12 table-responsive">
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
                                    <tr v-for="(item, index) in words" :key="index" :class="{boldrow: selectedWord == index}">
                                        <td v-text="item.word"></td>
                                        <td v-text="item.definition"></td>
                                        <td v-text="item.bangla"></td>
                                        <td v-text="item.sentence"></td>
                                        <td v-text="item.type"></td>
                                        <td>
                                            <input type="radio" :value="index" v-model="selectedWord">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const spellUserID = <?= $spelluser ?>;
</script>
<script src="{{ asset('assets/admin/spellit.js') }}"></script>
@endpush


