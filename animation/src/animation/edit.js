import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {
    const { animation } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={__('Animation Settings', 'fwd-blocks')}>
                    <SelectControl
                        label={__('Animation Type', 'fwd-blocks')}
                        value={animation}
                        options={[
                            { label: __('Fade Up', 'fwd-blocks'), value: 'fade-up' },
                            { label: __('Fade Down', 'fwd-blocks'), value: 'fade-down' },
                            { label: __('Fade Left', 'fwd-blocks'), value: 'fade-left' },
                            { label: __('Fade Right', 'fwd-blocks'), value: 'fade-right' },
                        ]}
                        onChange={(newAnimation) => setAttributes({ animation: newAnimation })}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()} data-aos={animation}>
                <InnerBlocks />
            </div>
        </>
    );
}
