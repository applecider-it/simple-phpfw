<meta charset="UTF-8">
<title>Simple PHPFW</title>
<style>
    body {
        font-family: sans-serif;
        line-height: 1.6;
        margin: 0;
        padding: 0;
    }

    header {
        background: #aaa;
        color: #333;
        padding: 0.5rem;
    }

    main {
        padding: 3rem 5rem;
    }

    h1 {
        font-size: 2rem;
        padding: 0.5rem;
        margin: 0.5rem;
    }

    .trace-exception-description {
        border: 1px solid #aaa;
        padding: 0.5rem;
        overflow-y: auto;
        white-space: pre-wrap;
        max-height: 15rem;
    }

    .trace-exception-lines {
        border: 1px solid #aaa;
        padding: 0.5rem;
        overflow-y: auto;
        white-space: pre-wrap;
        background: #ffe;
    }

    .trace-exception-lines>div>span {
        display: inline-block;
        width: 2.5rem;
    }

    .trace-exception-lines>div.active {
        background: #fdd;
    }

    #trace-all-exceptions-box {
        display: none;
    }

    #trace-all-exceptions-box.active {
        display: block;
    }

    footer {
        background: #eee;
        text-align: center;
        padding: 1rem;
    }
</style>