@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>SmartVillage DePIN Hub</h1>
        <p>Welcome, {{ Auth::user()->name }}!</p>
        <h2>Share a Resource</h2>
        <form id="resource-form" method="POST" action="{{ route('resources.store') }}">
            @csrf
            <label for="type">Resource Type (e.g., energy, internet):</label>
            <input type="text" name="type" id="type" required class="border p-2">
            <label for="amount">Amount (e.g., 10 kWh):</label>
            <input type="number" name="amount" id="amount" required class="border p-2">
            <button type="submit" class="bg-blue-500 text-white p-2">Share</button>
        </form>
        <p id="hedera-status"></p>
        <a href="{{ route('resources.index') }}" class="text-blue-500">View Community Hub</a>
        <h2>AI Prediction</h2>
        <a href="{{ route('resources.predict') }}" class="bg-green-500 text-white p-2">Get Prediction</a>
    </div>
    <script src="https://unpkg.com/@hashgraph/sdk@2.64.5/dist/browser/hedera.js"></script>
    <script>
        const accountId = '0.0.12345'; // Replace with your Account ID
        const privateKey = Hedera.PrivateKey.fromStringECDSA('302e020100...'); // Replace with your HEX key
        const topicId = '0.0.67890'; // Replace with your Topic ID

        document.getElementById('resource-form').addEventListener('submit', async (event) => {
            event.preventDefault();
            const type = document.getElementById('type').value;
            const amount = document.getElementById('amount').value;

            try {
                const client = Hedera.Client.forTestnet();
                client.setOperator(accountId, privateKey);

                const transaction = await new Hedera.TopicMessageSubmitTransaction({
                    topicId: topicId,
                    message: `Shared ${amount} of ${type}`
                }).execute(client);

                const receipt = await transaction.getReceipt(client);
                const txId = receipt.topicSequenceNumber;

                document.getElementById('hedera-status').innerText = `Logged to Hedera! Sequence: ${txId}`;

                const form = document.getElementById('resource-form');
                const formData = new FormData(form);
                formData.append('hedera_tx_id', txId);
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(() => window.location = '/dashboard');
            } catch (error) {
                document.getElementById('hedera-status').innerText = `Error: ${error.message}`;
            }
        });
    </script>
@endsection