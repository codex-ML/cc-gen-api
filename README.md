
  <h1>CC GEN API Usage Example</h1>
        <p>This page demonstrates how to use an API to retrieve data:</p>
        <ul>
            <li>To retrieve data, provide parameters in the URL:</li>
            <li><code>bin</code>: Specify the BIN (Bank Identification Number).</li>
            <li><code>s_date</code>: Start date for data retrieval (optional).</li>
            <li><code>year</code>: Year for data retrieval (optional).</li>
            <li><code>number</code>: Number of records to retrieve (optional).</li>
            <li><code>format</code>: Desired format of the retrieved data (optional). <code>pipe , csv , xml , json , sql</code></li>
        </ul>
        <p>Example usage: <code>/script.php?bin=123456&s_date=2023-01-01&number=10&format=csv</code></p>
        <p>The script will make a POST request to the API and display the retrieved data.</p>
