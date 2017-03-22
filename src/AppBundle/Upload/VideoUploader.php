<?php

namespace AppBundle\Upload;

use AppBundle\Entity\ResourceInterface;

/**
 * Class CommentFileUploader
 * @package AppBundle\Upload
 */
class CommentFileUploader extends AbstractFileUploader
{
    const DIR_PARAM = 'message_uploads_dir';
}