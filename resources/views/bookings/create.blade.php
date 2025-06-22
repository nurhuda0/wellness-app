@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h1>Create New Booking</h1>
<form method="POST" action="{{ route('bookings.store') }}">
    @csrf
    @if(isset($partner))
        <input type="hidden" name="partner_id" value="{{ old('partner_id', $partner->id) }}">
    @else
        <label>Partner:
            <select name="partner_id" required>
                <option value="">Select a partner</option>
                @foreach($partners as $p)
                    <option value="{{ $p->id }}" {{ old('partner_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </label><br>
    @endif
    <label>Date & Time: <input type="datetime-local" name="booking_time" value="{{ old('booking_time') }}" required></label><br>
    <label>Notes: <input type="text" name="notes" value="{{ old('notes') }}"></label><br>
    <button type="submit">Book</button>
</form>
