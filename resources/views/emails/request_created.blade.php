<h2>Approval Required</h2>

<p>A new request has been created and requires your approval.</p>


<p><strong>Item:</strong> {{ $request->item }}</p>
<p><strong>Justification:</strong> {{ $request->justification }}</p>
<p><strong>Requested By:</strong> {{ $request->requester->name }}</p>
<p><strong>Created At:</strong> {{ $request->created_at }}</p>

<p>
    <p>
    <a href="{{ url('/api/requests/' . $request->id . '/approve') }}">
        Approve
    </a>
    <br><br>

    <a href="{{ url('/api/requests/' . $request->id . '/reject') }}">
        Reject
    </a>
</p>
</p>

<br>

<p>Thank you.</p>