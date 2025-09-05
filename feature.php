<?php
$title = "Feature Forge";
$description = "Generate intelligent prompts for new product features. Free AI prompt generator for feature analysis.";
$keywords = "AI prompts, feature generator, product features, feature development, prompt generator";
$jsonld_name = "Feature Forge Prompt Generator";
$jsonld_desc = "Generate intelligent prompts for new product features.";
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
                Feature Forge Prompt Generator
              </h1>
              <form id="featureForm">
                <div class="mb-3">
                  <label for="feature" class="form-label">
                    Feature description <span class="required">*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="feature"
                    name="feature"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="title" class="form-label">
                    Product title <span class="required">*</span>
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="title"
                    name="title"
                    required
                  />
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">
                    Product description <span class="required">*</span>
                  </label>
                  <textarea
                    class="form-control"
                    id="description"
                    name="description"
                    rows="4"
                    required
                  ></textarea>
                </div>
                <div class="mb-3">
                  <label for="problem" class="form-label">
                    Problem product aims to solve <span class="required">*</span>
                  </label>
                  <textarea
                    class="form-control"
                    id="problem"
                    name="problem"
                    rows="4"
                    required
                  ></textarea>
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
        .getElementById("featureForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const feature = document.getElementById("feature").value.trim();
          const title = document.getElementById("title").value.trim();
          const description = document.getElementById("description").value.trim();
          const problem = document.getElementById("problem").value.trim();

          if (!feature || !title || !description || !problem) {
            alert("All fields are required");
            return;
          }

          const prompt = `You are a senior product manager with twenty years of experience. You have worked in senior roles in three of the FAANG companies. You are well sought out. In the last five years, you have consulted for twelve Fortune 500 companies. You are the proud product manager for three unicorns, guiding them from ideation to becoming a unicorn. Your track record includes the fact that every product you have been involved in makes at least USD$10million in annual return rate within its first five years.

I want to add a feature to a product. The details are below
Feature description: ${feature}
Product title: ${title}
Description: ${description}
Problem to be solved: ${problem}

You will provide the following information based on the idea.
1. Title of the feature
2. Description of the feature

No fluff. Be as concise as possible, without affecting the details being provided.`;

          document.getElementById("promptText").textContent = prompt;
          document.getElementById("output").style.display = "block";
        });

      // Clear form functionality
      document
        .getElementById("clearBtn")
        .addEventListener("click", function () {
          document.getElementById("featureForm").reset();
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
