/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from "@wordpress/i18n";

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	useBlockProps,
	InspectorControls,
	InnerBlocks,
} from "@wordpress/block-editor";
import { PanelBody, SelectControl } from "@wordpress/components";

const AOS_OPTIONS = [
	{ label: __("Fade Up", "school-blocks"), value: "fade-up" },
	{ label: __("Fade Down", "school-blocks"), value: "fade-down" },
	{ label: __("Fade Left", "school-blocks"), value: "fade-left" },
	{ label: __("Fade Right", "school-blocks"), value: "fade-right" },
	{ label: __("Zoom In", "school-blocks"), value: "zoom-in" },
	{ label: __("Zoom Out", "school-blocks"), value: "zoom-out" },
];
/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit(attributes, setAttributes) {
	return (
		<>
		<InspectorControls>
			<PanelBody title={__("animation settings", "school-blocks")}>
			<SelectControl
			label={__("animation type", "school-blocks")}
			value={attributes.aosAnimation}
			options={AOS_OPTIONS}
			onChange={(value)=>setAttributes({aosAnimation:value})}
			/>
			</PanelBody>
		</InspectorControls>
		<div { ...useBlockProps() } data-aos={attributes.aosAnimation}> <InnerBlocks /> </div>
		</>
	);
}
