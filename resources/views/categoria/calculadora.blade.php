<div>
    <!-- Smile, breathe, and go slowly. - Thich Nhat Hanh -->
    <form action="{{route('calcular')}}" method="GET">
        <label>Numreo 1</label>
        <input type="text" name="num1" value="{{$num1}}">
        <br>
        <label>Numreo 2</label>
        <input type="text" name="num2" value="{{$num2}}">
        <br>
        <label>Resulatdo</label>
        <input type="text" value="{{$resultado }}">
        <br>
        <button type="submit">calcular</button>
    </form>
</div>
