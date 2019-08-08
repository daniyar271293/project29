@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1 align="center">ToDo</h1></div>

                <div class="card-body">
                        <button type="button" class="btn btn-outline-dark mb-2" style="width:100%" data-toggle="modal" data-target="#myModal"><h3>Создать</h3></button>
                        <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Описание</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Дата создание</th>
                                    <th scope="col">Удалить</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td> <a href="{{ route('show', $task->id) }}"> {{ $task->title }} </a> </td>
                                        <td>{{ Str::limit($task->description, 120) }}</td>
                                        <td><?= $task->status === 1 ? '<span class="changeIcon" data-id="' . $task->id . '"><i class="fas fa-check"></i></span>' : '<span class="changeIcon" data-id="' . $task->id . '"><i class="fas fa-times"></i></span>' ?></td>
                                        <td>{{ $task->created_at->diffForHumans() }}</td>
                                        <td>
                                          <form action="{{ route('delete', $task->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i></button>
                                          </form>
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Переход в темную сторону</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('save') }}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название</label>
                        <input name="title" type="text"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите название..">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Описание</label>
                        <textarea name="description" class="form-control" id="exampleInputPassword1"></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark" style="width:100%">Назад пути нет</button>
                </form>
            </div>
          </div>
      
        </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function(){
      $(".changeIcon").click(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var element = $(this);
        $.ajax({
          type: 'PUT',
          url: '/home/' + id,
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
          data: {
            id: id,
            _token: "{{ csrf_token() }}",
          },
        }).then(function(data) {
            if (data.status == 1) {
              element.children('i').removeClass('fa-times').addClass('fa-check');
            } else {
              element.children('i').removeClass('fa-check').addClass('fa-times');
            }
        });
      });
    });
  </script>

