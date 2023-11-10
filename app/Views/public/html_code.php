<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>WP Social Ninja TikTok Access Code</title>
    <meta name='robots' content='max-image-preview:large'/>
    <link rel="icon" href="https://wpsocialninja.com/wp-content/uploads/2022/05/cropped-WPSN-New-fabicon-01-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://wpsocialninja.com/wp-content/uploads/2022/05/cropped-WPSN-New-fabicon-01-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://wpsocialninja.com/wp-content/uploads/2022/05/cropped-WPSN-New-fabicon-01-180x180.png" />

    <style>
        body {
            background: #f7f7f7;
            font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", Meiryo, "Helvetica Neue", sans-serif;
        }
        body * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .wrap {
            margin: 100px auto;
            max-width: 800px;
            padding: 20px;
            background: white;
            border-radius: 10px;
        }

        h1 {
            font-size: 24px;
            font-weight: 500;
            text-align: center;
        }

        textarea {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-top: 30px;
            color: #606060;
        }

        button {
            background: #0085ba;
            border-color: #0073aa #006799 #006799;
            color: #fff;
            text-decoration: none;
            text-shadow: 0 -1px 1px #006799, 1px 0 1px #006799, 0 1px 1px #006799, -1px 0 1px #006799;
            -webkit-appearance: none;
            border: 1px solid;
            border-radius: 3px;
            box-sizing: border-box;
            cursor: pointer;
            display: inline-block;
            font-size: .8rem;
            margin: 0;
            line-height: 1.953125rem;
            padding: 0 2rem;
        }
        .instruction img {
            max-width: 100%;
        }

        .instruction {
            background: #f0f5f8;
            margin: 60px -20px -20px;
        }
        h2 {
            text-align: center;
            font-size: 20px;
            line-height: 30px;
            padding-top: 20px;
        }
    </style>
</head>
<body>

<div class="wrap">
    <h1>Please copy the following code and paste into your WP Social Ninja TikTok configuration modal.</h1>
    <div>
        <textarea readonly id="code" rows="5"><?php echo isset($_GET['code']) ? $_GET['code'] : ''; ?></textarea>
        <div style="text-align: center;">
            <button id="copyButton">Copy</button>
        </div>
    </div>

    <div class="instruction">
        <h2>Instruction</h2>
        <img src="https://wpsocialninja.com/wp-content/uploads/2022/09/wpsn-google-access-code-instruction.png" />
    </div>
</div>

<script type="text/javascript">

    function fallbackCopyTextToClipboard(text) {
        var textArea = document.createElement("textarea");
        console.log('textArea', textArea);
        console.log('textArea', textArea.value);
        textArea.value = text;

        // Avoid scrolling to bottom
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
            document.execCommand('copy');
        } catch (err) {
            alert('Fallback: Oops, unable to copy');
        }

        document.body.removeChild(textArea);
    }
    function copyTextToClipboard(text) {
        if (!navigator.clipboard) {
            fallbackCopyTextToClipboard(text);
            return;
        }
        navigator.clipboard.writeText(text).then(function() {

        }, function(err) {
            alert('Async: Could not copy text');
        });
    }

    var btn = document.getElementById('copyButton');
    btn.addEventListener('click', function (e) {
        var textContent = document.getElementById('code').textContent;
        copyTextToClipboard(textContent);
        btn.innerHTML = '✔️ Copied';
        setTimeout(function () {
            btn.innerHTML = 'Copy';
        }, 2000);
    }, false);
</script>
</body>
</html>