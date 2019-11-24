<?php

namespace App\Rules;

use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Validation\Rule;

class IsCroppable implements Rule
{
	protected $cropName;

	/**
	 * Create a new rule instance.
	 *
	 * @param $cropName
	 */
	public function __construct($cropName)
	{
		$this->cropName = $cropName;
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$cropArrayName = $this->cropName;
		$DS = DIRECTORY_SEPARATOR;
		$currentDir = public_path('uploads'.$DS.'original');
		$img = $currentDir.$DS.$value;

		if (!is_file($img))
			return false;

		if (!$cropArrayName || !is_string($cropArrayName))
			return false;

		$cropArray = config('file-manager.custom_crops.'.$cropArrayName);

		if (!is_array($cropArray) || empty($cropArray))
			return false;

		$image = Image::make($img);

		// Image data
		$imgWidth  = $image->width();
		$imgHeight = $image->height();

		$imageRatio = $imgWidth / $imgHeight;

		// run on each crop
		foreach ($cropArray as $cropKey => $cropData) {

			// store the crop size in vars
			$targ_w = $cropData['width'];
			$targ_h = $cropData['height'];

			// if crop width bigger then the image width or the height is bigger then the image height continue to the next crop
			if ($targ_w > $imgWidth || $targ_h > $imgHeight)
				return false;

			// If the crop matches the exact ratio like the image + 0.03 -
			// Just resize to the crop size
			$currentCropRatio = $targ_w / $targ_h;

			if (!(round($imageRatio,2) < (round($currentCropRatio,2) + 0.03) && round($imageRatio,2) > (round($currentCropRatio,2) - 0.03))) {
				// get the width and height ration between the image and the crop
				$widthRatio  = $imgWidth / $targ_w;
				$heightRatio = $imgHeight / $targ_h;

				// get the smallest
				$smallestRatio = min ($widthRatio, $heightRatio );

				if($smallestRatio == $widthRatio)
					$finalRatio = $imgWidth / $targ_w;
				else
					$finalRatio = $imgHeight / $targ_h;

				$targ_w = $targ_w * $finalRatio;
				$targ_h = $targ_h * $finalRatio;

				$targ_x = (($imgWidth - $targ_w) / 2);
				$targ_y = (($imgHeight - $targ_h) / 2);

				if(($targ_w + $targ_x) > $imgWidth)
					return false;

				if(($targ_h + $targ_y) > $imgHeight)
					return false;
			}
		}
		return true;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'The :attribute is not croppable according to all sizes.';
	}
}