<button
        type="button"
        class="am-btn am-btn-warning"
        id="doc-confirm-toggle">
        Confirm
      </button>

      <ul class="am-list confirm-list" id="doc-modal-list">
        <li><a data-id="1" href="#">每个人都有一个死角， 自己走不出来，别人也闯不进去。</a><i class="am-icon-close"></i></li>
        <li><a data-id="2" href="#">我把最深沉的秘密放在那里。</a><i class="am-icon-close"></i></li>
        <li><a data-id="3" href="#">你不懂我，我不怪你。</a><i class="am-icon-close"></i></li>
        <li><a data-id="4" href="#">每个人都有一道伤口， 或深或浅，盖上布，以为不存在。</a><i class="am-icon-close"></i></li>
      </ul>

      <div class="am-modal am-modal-confirm" tabindex="-1" id="my-confirm">
        <div class="am-modal-dialog">
          <div class="am-modal-hd">Amaze UI</div>
          <div class="am-modal-bd">
            你，确定要删除这条记录吗？
          </div>
          <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
            <span class="am-modal-btn" data-am-modal-confirm>确定</span>
          </div>
        </div>
      </div>




<!-- <script>
$(function() {
    $('#doc-confirm-toggle').on('click', function() {
      $('#my-confirm').modal({
        relatedElement: this,
        onConfirm: function() {
          alert('你是猴子派来的逗比!')
        },
        onCancel: function() {
          alert('你不确定是不是猴子派来的逗比!')
        }
      });
    });
  }); -->
  </script>