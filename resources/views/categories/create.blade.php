<x-layout.main>
    <h1>CREA LA CATEGORIA</h1>
    @if (session('succes'))
    <div class="alert alert-danger" role="alert">
        {{session('succes')}}
      </div>
      @endif


    <form method="POST" action="{{route('categories.store')}}">
        @csrf
        <div class="mb-3">
          <label  class="form-label">Nome Categoria</label>
          <input type="text" class="form-control" name="name">
          @error('name')
              {{$message}}
          @enderror
        </div>

        <div class="form-floating">
            <textarea class="form-control" name="description"></textarea>
            <label for="floatingTextarea">Descrizione</label>
            @error('description')
            {{$message}}
        @enderror
          </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</x-layout.main>