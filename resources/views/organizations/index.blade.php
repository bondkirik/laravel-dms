@extends('layouts.app')

@section('title', 'Organizations')

@section('content')
    <div class="form-group row">
        <label for="company_id" class="col-sm-3 col-form-label">Company</label>
        <div class="col-sm-9">
            <select name="company_id" id="company_id">
                @foreach($corporations as $corporation)
                    @foreach($corporation->companies as $company)
                        <option value="{{ $company->id }}"
                            {{ session('company_id') === $company->id ? 'selected' : '' }}
                        >
                            [{{ $corporation->title }}] {{ $company->title }}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>

    <div class="btn-group">
        <a href="{{ route('corporations.add') }}" class="btn btn-xs">Add corporation</a>
        <a href="{{ route('companies.add') }}" class="btn btn-xs">Add company</a>
        <a href="{{ route('departments.add') }}" class="btn btn-xs">Add department</a>
    </div>

    <ul>
        @foreach($corporations as $corporation)
            <li>
                {{ $corporation->id }}
                <a href="{{ route('corporations.view', ['id' => $corporation->id]) }}">
                    {{ $corporation->title }}
                </a>
                <a href="{{ route('corporations.edit', ['id' => $corporation->id]) }}">
                    <i class="fa fa-pencil"></i>
                </a>
                <a href="{{ route('corporations.delete', ['id' => $corporation->id]) }}">
                    <i class="fa fa-trash"></i>
                </a>
            </li>

            <ul>
                @foreach($corporation->companies as $company)
                    <li>
                        {{ $corporation->id }}.{{ $company->id }}
                        <a href="{{ route('companies.view', ['id' => $company->id]) }}">
                            {{ $company->title }}
                        </a>
                        <a href="{{ route('companies.edit', ['id' => $company->id]) }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="{{ route('companies.delete', ['id' => $company->id]) }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </li>

                    <ul>
                        @foreach($company->departments as $department)
                            <li>
                                {{ $corporation->id }}.{{ $company->id }}.{{ $department->id }}
                                <a href="{{ route('departments.view', ['id' => $department->id]) }}">
                                    {{ $department->title }}
                                </a>
                                <a href="{{ route('departments.edit', ['id' => $department->id]) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="{{ route('departments.delete', ['id' => $department->id]) }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
