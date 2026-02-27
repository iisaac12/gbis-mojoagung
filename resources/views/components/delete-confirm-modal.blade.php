<!-- Custom Delete Confirmation Modal -->
<div id="deleteModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; backdrop-filter: blur(4px); align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;">
    <div style="background: white; width: 90%; max-width: 400px; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.2); transform: scale(0.9); transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1); text-align: center;">
        <div style="width: 70px; height: 70px; background: #fff5f5; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#c53030" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
        </div>
        
        <h3 style="margin: 0 0 0.75rem 0; color: #1a202c; font-size: 1.25rem; font-weight: 700;">Hapus Konten?</h3>
        <p id="deleteModalMessage" style="margin: 0 0 2rem 0; color: #718096; font-size: 0.95rem; line-height: 1.5;">Apakah Anda yakin ingin menghapus data ini secara permanen? Tindakan ini tidak dapat dibatalkan.</p>
        
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <button onclick="closeDeleteModal()" style="flex: 1; padding: 0.8rem; border-radius: 12px; border: 1px solid #e2e8f0; background: white; color: #4a5568; font-weight: 600; cursor: pointer; transition: all 0.2s;">Batal</button>
            <button id="confirmDeleteBtn" style="flex: 1; padding: 0.8rem; border-radius: 12px; border: none; background: #c53030; color: white; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#9b2c2c'" onmouseout="this.style.background='#c53030'">Ya, Hapus</button>
        </div>
    </div>
</div>

<script>
    let formToSubmit = null;

    function showDeleteModal(formId, message = null) {
        formToSubmit = document.getElementById(formId);
        const modal = document.getElementById('deleteModal');
        const modalContent = modal.querySelector('div');
        
        if (message) {
            document.getElementById('deleteModalMessage').innerText = message;
        } else {
            document.getElementById('deleteModalMessage').innerText = "Apakah Anda yakin ingin menghapus data ini secara permanen? Tindakan ini tidak dapat dibatalkan.";
        }

        modal.style.display = 'flex';
        // Force reflow
        modal.offsetHeight;
        modal.style.opacity = '1';
        modalContent.style.transform = 'scale(1)';
        
        // Handle confirm button click
        document.getElementById('confirmDeleteBtn').onclick = function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        };
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const modalContent = modal.querySelector('div');
        
        modal.style.opacity = '0';
        modalContent.style.transform = 'scale(0.9)';
        
        setTimeout(() => {
            modal.style.display = 'none';
            formToSubmit = null;
        }, 300);
    }

    // Close on outside click
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            closeDeleteModal();
        }
    }
</script>
