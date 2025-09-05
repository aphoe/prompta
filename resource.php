<?php
$title = "Resource Prompt Generator";
$description = "Generate intelligent prompts for general resources like articles, websites, and more. Free AI prompt generator for resource analysis.";
$keywords = "AI prompts, resource generator, articles, websites, prompt generator";
$jsonld_name = "Resource Prompt Generator";
$jsonld_desc = "Generate intelligent prompts for general resources like articles, websites, and more.";
?>
<!DOCTYPE html>
<html lang="en">
<?php include './includes/head.php'; ?>
<body>
<?php include './includes/nav.php'; ?>
    <main class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <h1 class="card-title text-center mb-4">
                Resource Prompt Generator
              </h1>
              <form id="resourceForm">
                <div class="mb-3">
                  <label for="name" class="form-label">
                    Name <span class="required">*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="url" class="form-label">URL (optional)</label>
                  <input type="url" class="form-control" id="url" name="url" />
                </div>
                <div class="d-flex flex-column flex-md-row gap-2">
                  <button type="submit" class="btn btn-primary flex-fill">
                    Generate Prompt
                  </button>
                  <button
                    type="button"
                    class="btn btn-outline-secondary"
                    id="clearBtn"
                  >
                    Clear Form
                  </button>
                </div>
              </form>
              <div id="output" class="mt-4" style="display: none">
                <h5 class="card-title">Generated Prompt:</h5>
                <pre id="promptText" class="bg-light p-3 rounded mb-2"></pre>
                <div class="d-flex gap-2">
                  <button id="copyBtn" class="btn btn-outline-secondary btn-sm">
                    Copy Prompt
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document
        .getElementById("resourceForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const name = document.getElementById("name").value.trim();
          const url = document.getElementById("url").value.trim();

          if (!name) {
            alert("Name is required");
            return;
          }

          const reference = url ? ` (reference: ${url})` : "";
          const prompt = `Give me the following information about ${name}${reference}
1. Official name
2. URL
3. is it open source
4. Top three tags associated with this resource
5. Detailed description`;

          document.getElementById("promptText").textContent = prompt;
          document.getElementById("output").style.display = "block";
        });

      // Clear form functionality
      document
        .getElementById("clearBtn")
        .addEventListener("click", function () {
          document.getElementById("resourceForm").reset();
          document.getElementById("output").style.display = "none";
          document.getElementById("promptText").textContent = "";
        });

      // Copy to clipboard functionality
      document.getElementById("copyBtn").addEventListener("click", function () {
        const promptText = document.getElementById("promptText").textContent;

        if (navigator.clipboard && window.isSecureContext) {
          // Use the Clipboard API when available
          navigator.clipboard
            .writeText(promptText)
            .then(function () {
              showCopyFeedback("Copied!");
            })
            .catch(function (err) {
              console.error("Failed to copy: ", err);
              fallbackCopyTextToClipboard(promptText);
            });
        } else {
          // Fallback for older browsers
          fallbackCopyTextToClipboard(promptText);
        }
      });

      function fallbackCopyTextToClipboard(text) {
        const textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();

        try {
          const successful = document.execCommand("copy");
          if (successful) {
            showCopyFeedback("Copied!");
          } else {
            showCopyFeedback("Copy failed!");
          }
        } catch (err) {
          console.error("Fallback: Oops, unable to copy", err);
          showCopyFeedback("Copy failed!");
        }

        document.body.removeChild(textArea);
      }

      function showCopyFeedback(message) {
        const copyBtn = document.getElementById("copyBtn");
        const originalText = copyBtn.textContent;
        copyBtn.textContent = message;
        copyBtn.classList.remove("btn-outline-secondary");
        copyBtn.classList.add("btn-success");

        setTimeout(function () {
          copyBtn.textContent = originalText;
          copyBtn.classList.remove("btn-success");
          copyBtn.classList.add("btn-outline-secondary");
        }, 2000);
      }
    </script>
  </body>
</html>
