<?php
$title = "Idea Forge";
$description = "Generate intelligent prompts for new product ideas. Free AI prompt generator for idea analysis.";
$keywords = "AI prompts, idea generator, product ideas, startup ideas, prompt generator";
$jsonld_name = "Idea Forge Prompt Generator";
$jsonld_desc = "Generate intelligent prompts for new product ideas.";
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
                Idea Forge Prompt Generator
              </h1>
              <form id="ideaForm">
                <div class="mb-3">
                  <label for="title" class="form-label">
                    Title <span class="required">*</span>
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
                  <label for="details" class="form-label">Details (optional)</label>
                  <textarea
                    class="form-control"
                    id="details"
                    name="details"
                    rows="4"
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
        .getElementById("ideaForm")
        .addEventListener("submit", function (e) {
          e.preventDefault();

          const title = document.getElementById("title").value.trim();
          const details = document.getElementById("details").value.trim();

          if (!title) {
            alert("Title is required");
            return;
          }

          const detailsClean = details.replace(/\r?\n/g, ' ');
          const description = details ? `Description: "${detailsClean}"` : "";
          const prompt = `You are a senior product manager with twenty years of experience. You have worked in senior roles in three of the FAANG companies. You are well sought out. In the last five years, you have consulted for twelve Fortune 500 companies. You are the proud product manager for three unicorns, guiding them from ideation to becoming a unicorn. Your track record includes the fact that every product you have been involved in makes at least USD$10million in annual return rate within its first five years.

          Here is an idea I want to build:
Idea: ${title}
${description}

You will provide the following information based on the idea.
1. Product title
2. Exact category such as saas, e-commerce, etc
3. Suggest a domain name
4. Suggest a brand name
5. Please give me a detailed description of the product
6. Describe the problems it aims to solve. This should be a bulleted list with each problem in bold, followed by a semi-colon and then a sentence-long explanation of the problem.
7. Write notes on the product. List as must details as possible.
8. Score the idea on a scale of 1-10 on the following criteria, with one being extremely poor and 10 being excellent.
a. Strategic Fit
b. Market Need/Value
c. Feasibility (Effort)
d. Monetization Potential
e. Excitement/Motivation
f. Uniqueness
g. Innovation
h. Target Audience Reach
i. Learning Potential
j. Operational Overhead
k. UX/UI Complexity
9. Add the reasons given for scoring of the idea to the notes
10. Please give me an exhaustive list of features. For each feature, provide a title and a detailed three-sentence description without fluff.
11. What are all the key knowledge/expertise required to build the product? Please give me a title and a description. Ignore common tech knowledge like UI/UX.

No fluff.`;

          document.getElementById("promptText").textContent = prompt;
          document.getElementById("output").style.display = "block";
        });

      // Clear form functionality
      document
        .getElementById("clearBtn")
        .addEventListener("click", function () {
          document.getElementById("ideaForm").reset();
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
