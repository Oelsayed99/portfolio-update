document.addEventListener('DOMContentLoaded', function() {
    // 1. Create Popup Element
    const popup = document.createElement('div');
    popup.id = 'translation-popup';
    popup.innerHTML = `
        <div class="popup-header">Edit Translation</div>
        <div id="popup-msgid" class="popup-msgid"></div>
        <div style="margin-bottom: 0.5rem; font-size: 0.85rem; font-weight: 600;">English (Read-only):</div>
        <div id="popup-en" style="font-size: 0.9rem; color: #666; margin-bottom: 1rem; font-style: italic;"></div>
        
        <div style="margin-bottom: 0.5rem; font-size: 0.85rem; font-weight: 600;">Current Translation:</div>
        <textarea id="popup-text" style="width: 100%; height: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; font-family: inherit; font-size: 0.9rem; margin-bottom: 1rem;"></textarea>
        
        <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
            <button id="popup-cancel" style="padding: 0.4rem 0.8rem; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">Cancel</button>
            <button id="popup-save" style="padding: 0.4rem 1rem; background: #a855f7; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: 600;">Save Changes</button>
        </div>
    `;
    document.body.appendChild(popup);

    let activeElement = null;
    let currentMsgId = '';
    let currentLang = '';

    // 2. Right-click Handler
    document.addEventListener('contextmenu', function(e) {
        const target = e.target.closest('.editable-translation');
        if (target) {
            e.preventDefault();
            
            activeElement = target;
            currentMsgId = target.getAttribute('data-msgid');
            currentLang = target.getAttribute('data-lang');
            
            document.getElementById('popup-msgid').textContent = currentMsgId;
            document.getElementById('popup-en').textContent = target.getAttribute('data-en');
            document.getElementById('popup-text').value = target.textContent;
            
            // Position popup
            popup.style.display = 'block';
            
            // Ensure popup is within viewport
            let x = e.clientX;
            let y = e.clientY;
            if (x + 350 > window.innerWidth) x = window.innerWidth - 370;
            if (y + 300 > window.innerHeight) y = window.innerHeight - 320;
            
            popup.style.left = x + 'px';
            popup.style.top = y + 'px';
        }
    });

    // 3. Popup Actions
    document.getElementById('popup-cancel').addEventListener('click', () => {
        popup.style.display = 'none';
    });

    document.getElementById('popup-save').addEventListener('click', async () => {
        const newText = document.getElementById('popup-text').value;
        const saveBtn = document.getElementById('popup-save');
        
        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        try {
            const response = await fetch('/admin/api/update-translation.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    msgid: currentMsgId,
                    language: currentLang,
                    new_text: newText
                })
            });

            const result = await response.json();

            if (result.success) {
                // Update UI immediately
                activeElement.textContent = newText;
                popup.style.display = 'none';
            } else {
                alert('Error: ' + (result.error || 'Unknown error'));
            }
        } catch (error) {
            alert('Failed to save translation: ' + error);
        } finally {
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save Changes';
        }
    });

    // Close on click outside
    document.addEventListener('click', (e) => {
        if (!popup.contains(e.target) && popup.style.display === 'block') {
            popup.style.display = 'none';
        }
    });
});
