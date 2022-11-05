// 主程式
import * as FilePond from 'filepond';
import '../../node_modules/filepond/dist/filepond.min.css';
// 預覽圖片
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import '../../node_modules/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';
// 驗證規則
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);

window.FilePond = FilePond