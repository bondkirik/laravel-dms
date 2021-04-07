@extends('layouts.app')

@section('title', 'Assign to organization')

@section('content')
    <h2>Add department</h2>

    <form method="post" action="{{ route('organizations.process', ['id' => $user->id]) }}">
        {{ csrf_field() }}

        <div class="form-group row">
            <label for="corporation_id" class="col-sm-3 col-form-label">Corporation</label>
            <div class="col-sm-9">
                <select name="corporation_id" id="corporation_id">
                    @foreach($corporations as $corporation)
                        <option value="{{ $corporation->id }}">{{ $corporation->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="company_id" class="col-sm-3 col-form-label">Company</label>
            <div class="col-sm-9">
                <select name="company_id" id="company_id">
                    @foreach($corporations as $corporation)
                        @foreach($corporation->companies as $company)
                            <option value="{{ $company->id }}">{{ $company->title }}</option>
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="department_id" class="col-sm-3 col-form-label">Department</label>
            <div class="col-sm-9">
                <select name="department_id" id="department_id">
                    @foreach($corporations as $corporation)
                        @foreach($corporation->companies as $company)
                            @foreach($company->departments as $department)
                                <option value="{{ $department->id }}">{{ $department->title }}</option>
                            @endforeach
                        @endforeach
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
