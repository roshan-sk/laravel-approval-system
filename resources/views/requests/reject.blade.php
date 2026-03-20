<h2 style="color: red;">Request ReJected Successfully</h2>

<hr>

<p><strong>Item:</strong> {{ $request->item }}</p>
<p><strong>Justification:</strong> {{ $request->justification }}</p>
<p><strong>Requested By:</strong> {{ $request->requested_by }}</p>
<p><strong>Created At:</strong> {{ $request->created_at->format('d M Y, H:i') }}</p>

